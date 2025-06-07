// Функция для загрузки файлов
document.getElementById('uploadForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData();
    const files = document.getElementById('fileInput').files;
    
    for (let i = 0; i < files.length; i++) {
        formData.append('files', files[i]);
    }
    
    try {
        const response = await fetch('/upload', {
            method: 'POST',
            body: formData
        });
        
        if (response.ok) {
            const data = await response.json();
            displayFiles(data);
        }
    } catch (error) {
        console.error('Ошибка при загрузке:', error);
    }
});

// Функция для отображения файлов
function displayFiles(files) {
    const fileList = document.getElementById('fileList');
    fileList.innerHTML = '';
    
    files.forEach(file => {
        const fileItem = document.createElement('div');
        fileItem.classList.add('file-item');
        
        fileItem.innerHTML = `
            <p>Название: ${file.name}</p>
            <p>Размер: ${file.size} байт</p>
            <a href="${file.downloadUrl}" download>Скачать</a>
        `;
        
        fileList.appendChild(fileItem);
    });
}
