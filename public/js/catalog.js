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
        params: config.params
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

            // TODO: Page

            // Params
            for (var pKey in this.params) {
                if (this.params.hasOwnProperty(pKey)) {
                    for (var vKey in this.params[pKey].values) {
                        if (this.params[pKey].values.hasOwnProperty(vKey)) {
                            this.$set(
                                this.params[pKey].values[vKey],
                                'active',
                                !!to.query[pKey]
                                && to.query[pKey].split(",").indexOf(vKey.substring(3)) > -1
                            );
                        }
                    }
                }
            }
        },

        loadData: function () {
            var that = this,
                postData = that.$route.query;
            postData.token = that.token;

            $.post("/api" + that.$route.path, postData)
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
            router.push({query: {brand: '0'}});
        },

        modifyParam: function (pKey) {
            var tmpString = '',
                query = this.$route.query;

            for (var vKey in this.params[pKey].values) {
                if (this.params[pKey].values.hasOwnProperty(vKey)
                    && this.params[pKey].values[vKey].active
                ) {
                    tmpString += vKey.substr(3) + ',';
                }
            }

            var tmpObj = {};
            if (tmpString) {
                tmpString = tmpString.substr(0, tmpString.length - 1);
            } else {
                // Будем писать 0 если нужны все значения параметра
                tmpString = '0';
            }

            tmpObj[pKey] = tmpString;
            router.push({query: tmpObj});
        }
    }
});