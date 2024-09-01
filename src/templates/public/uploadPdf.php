<?php

?>

<link rel="stylesheet" href="/assets/css/uploadPdf.css">
<script src="/assets/js/upload.js" defer ></script>

<div class="max-container" id="bodyUploadFile">

    <div id="uploadArea" class="uploadArea">
        <p>Arraste e Solte seus arquivos aqui!</p>
        <label for="file-upload" id="upload-button" class="upload-button">Selecione os arquivos</button>
        <input accept=".pdf" multiple type="file" name="file-upload" id="file-upload" multiple>
    </div>
    <div class="status">
        <p id="status-message">Ainda não há arquivos para enviar</p>
        <ul id="file-list"></ul>
        <button disabled id="send-files-button">Enviar aquivos</button>
    </div>


</div>