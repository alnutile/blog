<template>
    <section>
      <div class="span12">
        <div class="col-md-12">
          <div class="form-group">
            <input
            type="text"
            v-model="searching"
            class="span12 form-control"
            v-on:change="searchingFor"
            v-on:input="searchingForAuto"
            id="search"
            autocomplete="off"
            placeholder="Search for Posts and Projects Press Enter">
          </div>
        </div>
        <div v-if="showNoResults()" class="alert alert-warning">
          <span class="no-results">Looks like there are no results for <strong>"{{ searching }}"</strong></span>
        </div>
      </div>
      <transition name="fade">
        <div class="row-fluid" v-if="results.length > 0">
          <div class="col-md-6 span6 separate">
            <div class="list-group">
              <div class="lead list-group-item list-group-item-action active">
                Posts
                <span class="badge badge-default badge-pill pull-right">search score</span>
                </div>
              <div class="list-group-item" v-for="result in posts" v-bind:key="result.id" v-if="results.length > 0">
                <h4 class="list-group-item-heading">
                  <a class="title" :href="'/posts/' + result.id">{{ result.title }}</a>
                  <span class="badge badge-default badge-pill pull-right">{{ result.score.toFixed(2)}}</span>
                </h4>
                <p class="list-group-item-text">
                  {{ result.body.substr(0, 125) | striphtml}}....
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6 span6">
            <div class="list-group">
              <div class="lead list-group-item list-group-item-action active">
                Projects
                <span class="badge badge-default badge-pill pull-right">search score</span>
                </div>
              <div class="list-group-item" v-for="result in projects" v-bind:key="result.id" v-if="results.length > 0">
                <h4 class="list-group-item-heading">
                  <a class="title" :href="'/projects/' + result.id">{{ result.title }}</a>
                  <span class="badge badge-default badge-pill pull-right">{{ result.score.toFixed(2)}}</span>
                </h4>
                <div class="results media">
                  <img :src="this.Blog.cdn + '/' + result.file_name" class="media-object thumbnail pull-left">
                  <div class="media-body">
                    {{ result.body.substr(0, 125) }}....
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </section>
</template>


<script>
export default {
  created: function() {
    // this.searching = "Laravel";
    // this.is_searching = true;
    // this.searchingFor();
    // this.results = [1, 2, 3];
  },
  data() {
    return {
      searching: null,
      is_searching: false,
      total_found: 0,
      curent_page: 1,
      results: []
    };
  },
  computed: {
    projects: function() {
      return _.filter(this.results, function(item) {
        return item.type === 'project';
      });
    },
    posts: function() {
      return _.filter(this.results, function(item) {
        return item.type === 'post';
      });
    }
  },
  methods: {
    showNoResults() {
      if (
        this.results.length < 1 &&
        this.searching != null &&
        this.is_searching
      ) {
        setTimeout(function() {
          return true;
        }, 2000);
      }

      return false;
    },
    searchingForAuto() {
      if (this.searching.length > 1) {
        this.searchingFor();
      }
    },
    searchingFor() {
      this.is_searching = true;
      axios
        .get('/api/search?q=' + this.searching)
        .then(results => {
          console.log('sent get');
          console.log(results);
          this.results = results.data.data;
          this.$emit('resultsFound', this.results);
          this.total_found = results.data.total;
          this.curent_page = results.data.curent_page;
        })
        .catch(error => {
          console.log('error');
          console.log(error);
        });
    }
  }
};
</script>


<style>
a.title {
  text-decoration: underline;
  font-size: 150%;
}
.results {
  font-size: 120%;
  color: #4e4b4b;
}

.results img {
  max-width: 20%;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.no-results {
  font-size: 120%;
}
</style>