import Vue from 'vue/dist/vue.js';
import test from 'ava';
import SearchComponent from '../../resources/assets/js/components/Search.vue';


test("that it will return 1 item", t => {
    //t.true(Array.isArray(Search.data().items));

    let Search = Vue.extend(SearchComponent)
    let vm = new Search().$mount()

    let data = [
            {
                "id": 1,
                "title": "Foo bar"
            }
        ];
    vm.transformData(data);
    t.is(1, vm.items.length);

    data = [
        {
            "id": 1,
            "title": "Foo bar"
        }
    ];
    vm.transformData(data);
    t.is(1, vm.items.length);
});


test("The title can be accessed", t => {
    //t.true(Array.isArray(Search.data().items));

    let Search = Vue.extend(SearchComponent)
    let vm = new Search().$mount()

    let data = [
        {
            "id": 1,
            "title": "Foo bar"
        }
    ];
    vm.transformData(data);
    t.is("Foo bar", vm.items[0].title);

});