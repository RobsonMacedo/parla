<template>
  <div>
    <vue-dropzone
      ref="myVueDropzone"
      id="dropzone"
      :options="dropzoneOptions"
    ></vue-dropzone>
  </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
  props: ['value', 'url', 'token'],

  components: {
    vueDropzone: vue2Dropzone,
  },

  data() {
    const $this = this
    return {
      dropzoneOptions: {
        url: this.url,
        thumbnailWidth: 150,
        maxFilesize: 20,
        headers: { 'X-CSRF-TOKEN': '12345' },
        error: function(e, t) {
          e.previewElement.classList.add('dz-error'), (t = t.errors.file[0])
          for (
            var i = 0,
              n = (n = e.previewElement.querySelectorAll(
                '[data-dz-errormessage]',
              ));
            ;

          ) {
            if (i >= n.length) break
            n[i++].textContent = t
          }
        },
        success: function(t) {
          $this.sucesso(t)
        },
      },
    }
  },

  methods: {
    sucesso(t) {
      dd(t)

      const $this = this

      t.previewElement.classList.add('dz-success'), 'sucesso'

      $this.$store.dispatch('__loadUploads')
    },
  },
}
</script>
