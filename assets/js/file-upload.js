document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('attachment');
    const fileUploadText = document.querySelector('.file-upload-text');
    const fileUploadDisplay = document.querySelector('.file-upload-display');
    
    if (fileInput && fileUploadText) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const maxSize = 10 * 1024 * 1024;
                if (file.size > maxSize) {
                    alert('Plik jest za duży. Maksymalny rozmiar to 10MB.');
                    fileInput.value = '';
                    updateFileDisplay('Wybierz plik (max 10MB)', false);
                    return;
                }
                const allowedTypes = [
                    'image/jpeg', 'image/jpg', 'image/png', 'image/gif',
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'text/plain',
                    'application/zip',
                    'application/x-rar-compressed', 'application/vnd.rar'
                ];
                if (!allowedTypes.includes(file.type)) {
                    alert('Nieprawidłowy format pliku. Dozwolone formaty: JPG, PNG, GIF, PDF, DOC, DOCX, TXT, ZIP, RAR');
                    fileInput.value = '';
                    updateFileDisplay('Wybierz plik (max 10MB)', false);
                    return;
                }
                const fileName = file.name;
                const fileSize = formatFileSize(file.size);
                updateFileDisplay(`${fileName} (${fileSize})`, true);
            } else {
                updateFileDisplay('Wybierz plik (max 10MB)', false);
            }
        });
        fileUploadDisplay.addEventListener('dragover', function(e) {
            e.preventDefault();
            fileUploadDisplay.style.backgroundColor = '#f0f8ff';
            fileUploadDisplay.style.borderColor = '#f4a023';
        });
        fileUploadDisplay.addEventListener('dragleave', function(e) {
            e.preventDefault();
            fileUploadDisplay.style.backgroundColor = '';
            fileUploadDisplay.style.borderColor = '';
        });
        fileUploadDisplay.addEventListener('drop', function(e) {
            e.preventDefault();
            fileUploadDisplay.style.backgroundColor = '';
            fileUploadDisplay.style.borderColor = '';
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
    }
    
    function updateFileDisplay(text, hasFile) {
        fileUploadText.textContent = text;
        if (hasFile) {
            fileUploadText.classList.add('has-file');
        } else {
            fileUploadText.classList.remove('has-file');
        }
    }
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
});
