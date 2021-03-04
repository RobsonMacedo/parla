<template>
  <div>
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-12">
                <div class="btn-toolbar">
                  {{ getDataLength() }} uploads

                  <div
                    class="btn btn-danger btn-sm ml-auto"
                    data-toggle="modal"
                    data-target="#upload-modal"
                  >
                    <i class="fa fa-plus"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="scrollable">
            <div class="row">
              <div class="col-md-12">
                <div class="div">
                  <ul class="list-group">
                    <li
                      v-for="(upload, index) in getPaginated()"
                      :key="index"
                      @click="select(upload, true)"
                      :class="
                        'list-group-item cursor-pointer ' +
                          (current && current.id == upload.id ? 'active' : '')
                      "
                    >
                      <div class="row">
                        <div class="col-9">
                          <i class="fa fa-file"></i>
                          {{ upload.original_name }}
                        </div>

                        <div class="col-3 text-right">
                          <div class="row">
                            <div class="col-3"></div>

                            <div class="col-9 ml-auto">
                              <button
                                type="button"
                                class="pull-right btn btn-sm btn-primary"
                                v-clipboard:copy="upload.sharing_url"
                                v-clipboard:success="__clipboardCopySuccess"
                                v-clipboard:error="__clipboardCopyError"
                              >
                                <i class="fa fa-copy"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>

                  <paginate
                    :page-count="getPageCount()"
                    :page-range="3"
                    :margin-pages="1"
                    :click-handler="clickCallback"
                    :prev-text="'<<'"
                    :next-text="'>>'"
                    :container-class="'pagination pagination-sm justify-content-center mt-4'"
                    :page-class="'page-item'" :prev-class="'page-item'" :next-class="'page-item'"
                    :page-link-class="'page-link'" :prev-link-class="'page-link'" :next-link-class="'page-link'"
                  >
                  </paginate>




                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="current" class="col-md-9">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-12">
                <div class="text-left">
                  <div class="row">
                    <div class="col-md-12">
                      Preview
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card-body scrollable">
            <div class="row">
              <div class="col-md-12">
                <img
                  class="preview-panel img-fluid"
                  :src="current.url"
                  alt="Error loading"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['data', 'current', 'render'],

  data() {
    return {
      pageSize: 10,
      page: 1,
    }
  },

  methods: {
    getPaginated() {
      // dd(this.data)

      return this.data.data
        ? this.data.data.slice(
            (this.page - 1) * this.pageSize,
            this.page * this.pageSize,
          )
        : []
    },

    getPageCount() {
      if (this.data.data) {
        return Math.ceil(this.data.data.length / this.pageSize)
      } else {
        return 0
      }
    },

    getDataLength() {
      if (this.data.data) {
        return this.data.data.length
      } else {
        return 0
      }
    },

    __clipboardCopyError() {
      const $this = this

      $this.$swal({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCancelButton: false,
        timer: 2000,
        icon: 'error',
        title: 'Erro ao copiar',
      })
    },

    __clipboardCopySuccess() {
      const $this = this

      $this.$swal({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCancelButton: false,
        timer: 2000,
        icon: 'success',
        title: 'Link copiado para a área de transferência',
      })
    },

    select(upload) {
      this.current = upload
    },

    clickCallback(pageNum) {
      this.page = pageNum
    },
  },
}
</script>

<style lang="css">
.pagination {
}
.page-item {
}
.preview-panel {
  display: block;
  margin-left: auto;
  margin-right: auto;
  max-height: 600px;
}
</style>
