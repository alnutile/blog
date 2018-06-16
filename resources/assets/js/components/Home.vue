<template>
  <section>
    <div id="home">
        <div id="page-title">
            <h2>Alfred Nutile</h2>
        </div>
        <div id="wrapper" class="full">

            <div class="row-fluid">
              <elastic-search
                  v-on:resultsFound="hideBody"
              ></elastic-search>
            </div>

            <transition name="fade">
                <slot v-if="!hide"></slot>
            </transition>
        </div>
    </div>
  </section>
</template>

<script>
export default {
  data: function() {
    return {
      hide: false
    };
  },
  methods: {
    hideBody(results) {
      console.log("hide body");
      console.log(results);
      if (results.length > 0) {
        this.hide = true;
      }
    }
  }
};
</script>


<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>

