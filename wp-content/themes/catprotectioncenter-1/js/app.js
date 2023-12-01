var App = Vue.extend({});
var postList = Vue.extend({

    template:"#post-list-template",
    data: {
        title : "Geeks for Geeks",
        name  : "Vue.js",
        topic : "Instances"
    },
    methods : {
 
        // Creating function
        show: function(){
            return "Welcome to this tutorial on "
                + this.name + " - " + this.topic;
        }
    }
});
var router = new VueRouter();
router.map({
    '/':{
        component: postList
    } 
})
router.start(App, '#app');