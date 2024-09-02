document.addEventListener('DOMContentLoaded', () => {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('file-upload');
    const statusMessage = document.getElementById('status-message');
    const fileList = document.getElementById('file-list');
    const sendFilesButton = document.getElementById('send-files-button');

    // Certifique-se de que os elementos existem antes de tentar acessar seus valores
    const maxFile = parseInt(document.getElementById('max_file')?.value) || 5; 
    const maxFileSize = 1024 * 1024 * (parseInt(document.getElementById('max_file_size')?.value) || 5); // 5MB 

    
    // Array para armazenar os arquivos PDF
    let files = [];

    // Função para atualizar a lista de arquivos
    const updateFileList = () => {
        fileList.innerHTML = '';
        if (files.length === 0) {
            sendFilesButton.setAttribute('disabled', 'true');  // Desabilita o botão
            statusMessage.textContent = 'Ainda não há arquivos para enviar';
        } else {
            //deixar enviar 
            sendFilesButton.removeAttribute('disabled');
            statusMessage.textContent = `${files.length} file(s) uploaded`;
            files.forEach((file, index) => {
                const listItem = document.createElement('li');
                listItem.textContent = file.name;

                const removeButton = document.createElement('button');
                // <i class="fa-solid fa-xmark"></i>
                const icone_remove =  document.createElement('i');
                icone_remove.classList.add('fa-solid', 'fa-xmark');
                removeButton.appendChild(icone_remove);
                removeButton.className = 'remove-button';
                removeButton.addEventListener('click', () => {
                    files.splice(index, 1);
                    updateFileList();
                });

                listItem.appendChild(removeButton);
                fileList.appendChild(listItem);
            });
        }
    };

    // Função para lidar com arquivos selecionados
    /*
    * @param {FileList} selectedFiles - Lista de arquivos selecionados
    */
    const handleFiles = (selectedFiles) => {
        // Verifica se o número de arquivos excede o limite
        if (files.length + selectedFiles.length > maxFile) {
            alert(`You can only upload up to ${maxFile} files`);
            return;
        }

        // Verifica se o tamanho dos arquivos excede o limite
        for (let i = 0; i < selectedFiles.length; i++) {
            if (selectedFiles[i].size > maxFileSize) {
                alert(`File ${selectedFiles[i].name} is too large. Max file size is ${maxFileSize / (1024*1024)} MB`);
                return;
            }
        }

        const newFiles = Array.from(selectedFiles);
        newFiles.forEach(file => {
            // Verifica se o arquivo já está na lista
            if (!files.some(existingFile => existingFile.name === file.name)) {
                files.push(file);
            }
        });
        updateFileList();
    };

    // Configurações do drag-and-drop
    uploadArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        uploadArea.classList.add('dragging');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('dragging');
    });

    uploadArea.addEventListener('drop', (event) => {
        event.preventDefault();
        uploadArea.classList.remove('dragging');
        handleFiles(event.dataTransfer.files);
    });

    // Clique no botão para abrir o seletor de arquivos
    document.getElementById('upload-button').addEventListener('click', () => {
        fileInput.click();
    });

    // Arquivos selecionados através do seletor de arquivos
    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });


    //enviar arquivos para o servidor
    async function sendFilesToServer(){
        const formData = new FormData();
        files.forEach(file => {
            formData.append('files[]', file);
        });

        const response = await fetch('/upload', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            alert('Files uploaded successfully');
            files = [];
            updateFileList();
        } else {
            alert('Failed to upload files');
        }
    }
        



});