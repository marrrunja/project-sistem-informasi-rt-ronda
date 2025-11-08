  const uploadBox = document.getElementById('uploadArea');
  const fileInput = document.getElementById('fileInput');

  fileInput.addEventListener('change', () => {
      if (fileInput.files.length > 0) {
          uploadBox.querySelector('.upload-label').textContent = fileInput.files[0].name;
          uploadBox.querySelector('p').textContent = "File berhasil dipilih";
      }
  });
