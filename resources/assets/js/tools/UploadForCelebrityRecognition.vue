<template>
<section>
        <div class="panel panel-default">
            <div class="panel-heading">Upload Celebrity Image (or dare to upload your own) </div>
              <div class="panel-body">
                <form role="form">
                    <div class="form-group text-center">
                        <label type="button" class="btn btn-primary btn-upload" :disabled="form.busy">
                            <span>Upload</span>
                            <input ref="image" type="file" class="form-control" name="image" @change="postNewImage">
                        </label>
                    </div>
                </form>
              </div>
            </div>
        </div>
</section>
</template>

<script>
export default {
  data() {
    return {
      path: false,
      images: [],
      form: {}
    };
  },
  methods: {
    postNewImage(e) {
      e.preventDefault();
      axios
        .post('/api/recognize/celebrities', this.gatherFormData())
        .then(results => {
          console.log('Success');
          console.log(results);
        })
        .catch(error => {
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
