<template>
  <div>
    <form>
      <div class="form-group">

        <textarea
        class="form-control"
        v-model="a2j"
        name="a2j"
        id="a2j"
        cols="30"
        rows="10" placeholder="[ 'foo': 'baz' ]">
        </textarea>
      </div>
        <div class="form-group">
          <button class="btn btn-success" type="button" v-on:click="convertA2J()">
            <i class="fa fa-retweet"></i> convert
        </button>
        <button class="btn btn-default" type="button" v-on:click="sampleA2J()">
            <i class="fa fa-retweet"></i> sample
        </button>
        </div>
    </form>
    <hr>
    <h2>Output</h2>
    <pre>{{ converted_a2j }}</pre>
  </div>
</template>


<script>
export default {
  data() {
    return {
      a2j: null,
      converted_a2j: null,
      example: `[
        "foo" => "bar",
        "baz" => [
            1,2,3
        ]
]`
    };
  },

  methods: {
    sampleA2J() {
      this.a2j = this.example;
      console.log(Array.isArray(this.a2j));

      this.convertA2J();
    },
    convertA2J() {
      axios.post("a2j", { data: this.a2j }).then(results => {
        console.log(results.data);
        this.converted_a2j = results.data;
      });
    }
  }
};
</script>
