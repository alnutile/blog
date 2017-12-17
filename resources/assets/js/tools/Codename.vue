<template>
  <div>
    <form>
      <div class="form-group">

        <h3>Your Generated Name: {{ codename }}</h3>

      </div>
        <div class="form-group">
        <button class="btn btn-default" type="button"  v-on:click="generate()">
            <i class="fa fa-retweet"></i> generate
        </button>
        </div>
    </form>
    <hr>
  </div>
</template>


<script>
export default {
  mounted: function() {
    this.generate();
  },
  data() {
    return {
      codename: null
    };
  },

  methods: {
    generate() {
      axios.post("codenames", {}).then(results => {
        this.codename = results.data;
      });
    }
  }
};
</script>
