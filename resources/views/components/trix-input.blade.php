@props(['id', 'name', 'value' => '', 'attachment' => false])

{{-- More detailed dump: --}}

<input type="hidden" name="{{ $name }}" id="{{ $id }}_input" value="{{ $value }}" />

<trix-toolbar  class="[&_.trix-button]:dark:bg-white [&_.trix-button]:bg-white [&_.trix-button.trix-active]:bg-gray-300 "
    id="{{ $id }}_toolbar"></trix-toolbar>

<trix-editor id="{{ $id }}" toolbar="{{ $id }}_toolbar" input="{{ $id }}_input"
    {{ $attributes->merge(['class' => 'trix-content border-gray-300 dark:border-gray-700 dark:bg-stone-700 dark:text-gray-300 focus:ring-1 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm dark:[&_pre]:!bg-gray-700 dark:[&_pre]:rounded dark:[&_pre]:!text-white']) }}></trix-editor>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const trixEditor = document.getElementById('{{ $id }}');
        const csrfToken = document.head.querySelector('meta[name=csrf-token]')?.content;
        const uploadUrl = '{{ route('attachments.store') }}';


        if (!trixEditor) {
            console.error('Trix editor with ID "{{ $id }}" not found.');
            return;
        }

        @if ($attachment)
            trixEditor.addEventListener('trix-attachment-add', function(event) {
                if (event.attachment.file) {
                    console.log(
                        'Attachment event triggered for {{ $id }}, preparing for upload...'
                    ); // Mirip 'console.log('bisa')'
                    uploadAttachment(event.attachment);
                }
            });
        @else
            trixEditor.addEventListener('trix-file-accept', function(event) {
                event.preventDefault();
            });
            trixEditor.addEventListener('trix-attachment-add', function(event) {
                if (event.attachment.file) {
                    event.attachment.remove();
                }
            });
        @endif

        function uploadAttachment(attachment) {
            const formData = new FormData();
            formData.append('attachment', attachment.file);

            if (!csrfToken) {
                console.error('CSRF token not found. Attachment upload aborted.');
                attachment.remove();
                return;
            }

            fetch(uploadUrl, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errData => {
                            throw new Error(errData.message ||
                                `Server responded with ${response.status}`);
                        }).catch(() => {
                            throw new Error(`Server responded with ${response.status}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.attachment_url) {
                        attachment.setAttributes({
                            url: data.attachment_url,
                            href: data.attachment_url // Trix uses href for non-image file links
                        });
                    } else {
                        throw new Error('Invalid response from server: attachment_url missing.');
                    }
                })
                .catch(error => {
                    console.error('Attachment upload failed for {{ $id }}:', error.message);
                    attachment.remove();
                });
        }
    });
</script>
