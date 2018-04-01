<template>
    <section>
        <div class="form-group">
            <input
            type="text"
            v-model="searching"
            class="form-control"
            v-on:change="searchingFor"
            id="search"
            placeholder="Search for Posts and Projects">
        </div>
    </section>
</template>


<script>
export default {
  data() {
    return {
      searching: null
    };
  },
  methods: {
    searchingFor() {
      console.log(this.searching);
    }
  }
};
</script>
