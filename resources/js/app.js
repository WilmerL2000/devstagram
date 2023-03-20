import Dropzone from "dropzone";

Dropzone.autoDiscover = false;
const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const imagePublished = {};
            imagePublished.size = 1234;
            imagePublished.name =
                document.querySelector('[name="image"]').value;

            /* It's calling the function `addedfile` from the options of the dropzone. */
            this.options.addedfile.call(this, imagePublished);
            /* It's calling the function `thumbnail` from the options of the dropzone. */
            this.options.thumbnail.call(
                this,
                imagePublished,
                `/uploads/${imagePublished.name}`
            );

            imagePublished.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }
    },
});

dropzone.on("success", function (file, response) {
    document.querySelector('[name="image"]').value = response.image;
});

dropzone.on("removedfile", function () {
    document.querySelector('[name="image"]').value = "";
});
