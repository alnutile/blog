<template>
  <div>
    <form>
      <div class="form-group">

        <textarea
        class="form-control"
        v-model="j2a"
        name="j2a"
        id="j2a"
        cols="30"
        rows="10" placeholder="[ 'foo': 'baz' ]">
        </textarea>
      </div>
        <div class="form-group">
          <button class="btn btn-success" type="button" v-on:click="convertJ2A()">
            <i class="fa fa-retweet"></i> convert
        </button>
        <button class="btn btn-default" type="button"  v-on:click="sampleJ2A()">
            <i class="fa fa-retweet"></i> sample
        </button>
        </div>
    </form>
    <hr>
    <h2>Output</h2>
    <pre>{{ converted_j2a }}</pre>
  </div>
</template>


<script>
export default {
  data() {
    return {
      j2a: null,
      converted_j2a: null,
      example: `{
    "_id": "5a35650546b80b34e40e362f",
    "index": 0,
    "guid": "69df2e54-dc5a-40d3-a945-1f6f046e9d72",
    "isActive": true,
    "balance": "$3,217.79",
    "picture": "http://placehold.it/32x32",
    "age": 28,
    "eyeColor": "green",
    "name": "Arlene Ward",
    "gender": "female",
    "company": "OVOLO",
    "email": "arleneward@ovolo.com"
  }`
    };
  },

  methods: {
    sampleJ2A() {
      this.j2a = this.example;
      this.convertJ2A();
    },
    convertJ2A() {
      axios.post("j2a", { data: this.j2a }).then(results => {
        this.converted_j2a = results.data;
      });
    }
  }
};
</script>
