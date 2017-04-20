Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history'
});
const app = new Vue({
    router,
    el: '#vue-catalog',
    data: {
        brands: config.brands,
        totalPages: config.totalPages,
        token: config.token,
        params: {}
    },
    mounted: function () {
        this.updateFilters(this.$route);
    },
    watch: {
        '$route' (to, from) {
            this.updateFilters(to);
            this.loadData();
        }
    },
    methods: {
        updateFilters: function (to) {
            // Brands
            for (var key in this.brands) {
                if (this.brands.hasOwnProperty(key)) {
                    this.$set(this.brands[key], 'active', to.query.brand == key);
                }
            }

            // Page
            // Params
        },

        loadData: function () {
            var that = this;

            $.post(
                "/api" + that.$route.path + "/",
                {
                    token: that.token,
                    brand: that.$route.query.brand,
                    page: that.$route.query.page,
                }
            )
            .done(function(data) {
                $('.shop-grid.grid-view').html(data.html);
                $('.page-selector .description').html(data.countInfo);
                that.totalPages = data.totalPages;
            })
            .fail(function() {
                // location.reload();
            });
        },

        unsetBrand: function () {
            var tmp = this.$route.query;
            delete tmp.brand;

            if ($.isEmptyObject(tmp)) {
                console.log('Не работает пока');
                router.replace({path: this.$route.path, query: {}});
            } else {
                router.replace({query: tmp});
            }
        }
    }
});