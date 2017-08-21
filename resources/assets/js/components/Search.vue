<template>
    <div class="Typeahead">
        <i class="fa fa-spinner fa-spin" v-if="loading"></i>
        <template v-else>
            <i class="fa fa-search" v-show="isEmpty"></i>
            <i class="fa fa-times" v-show="isDirty" @click="reset"></i>
        </template>

        <input type="text"
               class="Typeahead__input"
               placeholder="Search blog posts"
               autocomplete="off"
               v-model="query"
               @keydown.down="down"
               @keydown.up="up"
               @keydown.enter="hit"
               @keydown.esc="reset"
               @blur="reset"
               @input="update"/>

        <ul v-show="hasItems">
            <li v-for="(item, $item) in items" :class="activeClass($item)" @mousedown="hit" @mousemove="setActive($item)">
                <span class="name" v-text="item.title"></span>
            </li>
        </ul>
    </div>
</template>


<script>
    import VueTypeahead from 'vue-typeahead';

    export default {
        extends: VueTypeahead,
        data() {
            //top: 89px; left: 485px; width: 558px;

            return {
                "src": '/search',
                "limit": 5,
                "minChars": 3,
                "queryParamName": "search",
                "top": "89px",
                "left": "405px",
                "width": "558px",
                "query": "",
                "items": []
            }
        },
        computed: {
            hasItems () {
                console.log("has items");
                return this.items.length > 0;
            }
        },
        methods: {
            fetch () {
                const src = this.queryParamName
                    ? this.src
                    : this.src + this.query

                const params = this.queryParamName
                    ? Object.assign({ [this.queryParamName]: this.query }, this.data)
                    : this.data

                let cancel = new Promise((resolve) => this.cancel = resolve)
                let request = axios.get(src, { params })

                return Promise.race([cancel, request])
            },
            onHit (item) {
                // alert(item)
                window.location.href = '/posts/' + item.id;
            },
            prepareResponseData (data) {
                // data = ...
                console.log("prepare");
                console.log(data);
                return data
            },
            trimTitle (title) {
                if (title.length > 60) {
                    return title.substring(0, 57) + '....';
                }
                return title;
            },
            transformData (data) {
                if (data !== 'undefined' && data.length > 0) {
                    let that = this;
                    that.items = [];
                    data.map(function (item) {
                        that.items.push(
                                {
                                    "id": item.id,
                                    "title": that.trimTitle(item.title)
                                }
                        );
                    });
                }
            }
        }
    }
</script>


<style scoped>
    .Typeahead {
        position: relative;
    }
    .Typeahead__input {
        width: 100%;
        font-size: 14px;
        color: #2c3e50;
        line-height: 1.42857143;
        box-shadow: inset 0 1px 4px rgba(0,0,0,.4);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        font-weight: 300;
        padding: 12px 26px;
        border: none;
        border-radius: 22px;
        letter-spacing: 1px;
        box-sizing: border-box;
    }
    .Typeahead__input:focus {
        border-color: #4fc08d;
        outline: 0;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px #4fc08d;
    }
    .fa-times {
        cursor: pointer;
    }
    i {
        float: right;
        position: relative;
        top: 30px;
        right: 29px;
        opacity: 0.4;
    }
    ul {
        position: absolute;
        padding: 0;
        left: -10px;
        margin-top: -5px;
        min-width: 95%;
        background-color: #fff;
        list-style: none;
        border-radius: 4px;
        box-shadow: 0 0 10px rgba(0,0,0, 0.25);
        z-index: 1000;
    }
    li {
        padding: 10px 16px;
        border-bottom: 1px solid #ccc;
        cursor: pointer;
    }
    li:first-child {
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
    }
    li:last-child {
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        border-bottom: 0;
    }
    span {
        display: block;
        color: #2c3e50;
    }
    .active {
        background-color: #3aa373;
    }
    .active span {
        color: white;
    }
    .name {
        font-weight: 700;
        font-size: 18px;
    }
    .screen-name {
        font-style: italic;
    }

</style>