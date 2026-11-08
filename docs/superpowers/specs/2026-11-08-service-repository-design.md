# Satpol Portal — Service & Repository Architecture (Phase 1)

## Intent

The portal (Satpol PP) was a typical Laravel "fat controller" app: validation, file uploads,
database writes, DataTables formatting and rich-text rendering all lived in controllers.
This refactor introduces a layered application architecture so the codebase can be used as a
portfolio piece and is easier to maintain when framework or library versions change.

## Goals

- Move write workflows (validation already at the HTTP boundary) into **Services**.
- Isolate persistence behind **Repository contracts** for the aggregates that carry real
  query/workflow logic (`News`, `Gallery`, `Service`).
- Put third-party coupling (file storage, rich text, DataTables) behind small **ports**.
- Make every write path transactional and clean up orphaned files.
- Cover the behaviour with **Pest** feature + unit tests.

## Non-goals

- No full hexagonal architecture: Eloquent models remain the domain model. Rewriting them into
  pure entities would break the rich-text package and DataTables integration for little gain.
- No repository for trivial CRUD (`SOP`, `Slider`, `Category`, `ServiceItem`, `ProfileItems`).
  They keep Eloquent inside their service; the seam is the service, not the repository.
- No generic `BaseRepository` / `BaseService`. Each contract is explicit.

## Constraints

- PHP 8.2+, Laravel 12, SQLite in tests, public disk for uploads.
- `tonysm/rich-text-laravel` owns the `body` field on `News` and `ProfileItems`.
- `yajra/laravel-datatables-oracle` owns the DataTables JSON shape expected by the views.
- No existing test coverage before this work; characterization tests were added first.

## Architecture

```
HTTP (Controller + FormRequest)
  -> Service (use case, transaction, file orchestration)
       -> Repository contract (persistence)   [News, Gallery, Service only]
       -> Port contracts (ImageStorage, RichTextRenderer)
  -> Eloquent model (rich text, relations)
```

- **Controllers** are thin: inject a service, call it, shape the response.
- **FormRequests** own validation and authorization.
- **DTOs** (`App\Data\*`) carry validated input into services; they are framework-agnostic.
- **Services** own transactions, file lifecycle and multi-table writes.
- **Repositories** (`App\Contracts\Repositories\*` + `App\Repositories\Eloquent\*`) own queries.
- **Ports** (`App\Contracts\*`) isolate `Storage`, `tonysm/rich-text-laravel`.

## Module coverage (Phase 1)

| Module | Service | Repository | Port usage |
|---|---|---|---|
| News | NewsService | NewsRepository | ImageStorage, RichTextRenderer |
| Gallery | GalleryService | GalleryRepository | ImageStorage |
| Service (+ items) | ServiceService | ServiceRepository | ImageStorage |
| Category | CategoryService | — (Eloquent) | — |
| Slider | SliderService | — | ImageStorage |
| ProfileItems | ProfileItemService | — | ImageStorage |
| SOP | SopService | — | — |
| Attachments | AttachmentService | — | ImageStorage |
| Dashboard | DashboardService | News/Gallery (counts) | — |

## Bugs fixed along the way

- `News::$fillable` was missing `author`, so author was silently dropped.
- `Gallery::$fillable` still referenced the dropped `category` column instead of `category_id`.
- `News::destroy` never deleted image files (orphans). Now deletes them in a transaction.
- `Gallery`/`Slider` deleted files via hidden model `boot` hooks; moved into services for one owner.
- Dashboard and profile views crashed on empty collections; guarded with null checks.

## Test strategy

- Pest (converted from PHPUnit) with `RefreshDatabase` on SQLite.
- Feature tests per module: create/update/delete happy paths, validation, DataTables endpoints.
- Services are unit-testable through their contracts; `Mockery` closes after each test.
- `Storage::fake('public')` for all upload paths.

## Phase 2 (uniform repositories)

Phase 1 was deliberately selective. To reach the "full layered" variant, add repository
contracts for `SOP`, `Slider`, `Category`, `ServiceItem` and `ProfileItems`, and replace the
direct Eloquent calls inside their services. Because controllers only talk to services and
services already receive dependencies through constructors, this is mechanical and does not
touch the HTTP layer or the tests' expectations. See ADRs below.

## ADRs

- **ADR-001** Repositories only where query logic exists. Trivial CRUD goes through Eloquent
  inside the service; the service is the seam.
- **ADR-002** Third-party coupling is isolated behind ports (`ImageStorage`,
  `RichTextRenderer`), not repositories. That is what actually protects against version
  upgrades.
- **ADR-003** No `BaseRepository`/`BaseService`. Explicit contracts only.
- **ADR-004** File deletion moved out of model `boot` hooks into the owning service, so the
  lifecycle has one owner and is transactional.