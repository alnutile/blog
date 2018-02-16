<template>
<section>
        <div class="panel panel-default">
              <div class="panel-heading">
                Rekognition API from Amazon
              </div>
              <div class="panel-body">
                <tabs>
                  <tab title="Celebrities API">
                    <celebrity-api></celebrity-api>
                  </tab>
                  <tab title="OCR API">
                    <text-api></text-api>
                  </tab>
                  <tab title="Face API">
                    <face-api></face-api>
                  </tab>
                </tabs>
              </div>
        </div>
</section>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {}
};
</script>
