<template>
<section>
<div class="col-md-8">
                  <h4>Upload some images of text, photos with signs, book covers etc</h4>
                  <form role="form">
                    <div class="form-group text-center">
                        <label type="button" :disabled="form.busy">
                            <span>Upload</span>
                            <input ref="image" type="file" class="form-control" name="image" @change="postNewImage">
                        </label>
                    </div>

                    <div class="form-group text-center">
                      <img :src="image_uploaded" alt="" class="img-resposive" style="max-width: 600px;">
                    </div>
                </form>
                </div>
                <div class="col-md-4">
                  <h4 class="text-center">Results will show here</h4>
                  <div class="text-center" v-if="loading">
                    <i class="fa fa-gears fa-spin fa-5x"></i>
                  </div>
                  <ul class="list-unstyled">
                    <li v-if="results.length > 0" v-for="result in results">
                      <ul>
                        <li>Text: {{ result.name }}</li>
                        <li>Confidence: {{ result.confidence }}</li>
                      </ul>
                    </li>
                  </ul>
                </div>
</section>
</template>

<script>
export default {
  data() {
    return {
      path: false,
      images: [],
      form: {},
      image_uploaded: null,
      results: [],
      loading: false
    };
  },
  methods: {
    showPreview() {
      var reader = new FileReader();
      let file = this.$refs.image.files[0];
      reader.onload = event => {
        this.image_uploaded = event.target.result;
      };
      reader.readAsDataURL(file);
    },
    postNewImage(e) {
      this.loading = true;
      this.results = [];
      e.preventDefault();
      this.showPreview();
      swal({
        title: 'Uploading image and getting results',
        timer: 2000
      });
      axios
        .post('/api/recognize/text', this.gatherFormData())
        .then(results => {
          this.results = results.data;
          this.loading = false;
        })
        .catch(error => {
          swal({
            title: 'Error getting results sorry :(',
            timer: 2000,
            icon: 'warning'
          });

          console.log('error');
          console.log(error);
        });
    },
    gatherFormData() {
      const data = new FormData();

      data.append('image', this.$refs.image.files[0]);

      return data;
    }
  }
};
</script>
