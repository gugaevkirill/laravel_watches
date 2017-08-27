Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history'
});
const app = new Vue({
    router,
    el: '#vue-catalog',
    data: {
        brands: config.brands,
        currentPage: config.currentPage,
        token: config.token,
        params: config.params
    },
    mounted: function () {
        this.updateFilters(this.$route);

        $(document).on('click', '.pages-box > .square-button', function(event) {
            router.replace({ query: { page: $(event.target).text() }})
        })
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
            this.$set(this, 'currentPage', to.query['page'] || 1);

            // Params
            for (var pKey in this.params) {
                if (this.params.hasOwnProperty(pKey)) {
                    // Если параметр допускает только одно значение
                    if (this.params[pKey].hasOwnProperty('value')) {
                        this.$set(
                            this.params[pKey],
                            'value',
                            to.query[pKey] || '0'
                        );
                    } else {
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
                $('.page-selector > .pages-box').html(data.pagenInfo);
            })
            .fail(function() {
                // location.reload();
            });
        },

        unsetBrand: function () {
            router.replace({query: {brand: '0', page: 1}});
        },

        /**
         * Для множественных параметров
         * @param pKey
         */
        updateRouteParam: function (pKey) {
            var tmpString = '';

            for (var vKey in this.params[pKey].values) {
                if (this.params[pKey].values.hasOwnProperty(vKey)
                    && this.params[pKey].values[vKey].active
                ) {
                    tmpString += vKey.substr(3) + ',';
                }
            }

            if (tmpString) {
                tmpString = tmpString.substr(0, tmpString.length - 1);
            } else {
                // Будем писать 0 если нужны все значения параметра
                tmpString = '0';
            }

            var tmpObj = this.getRouteQuery();
            tmpObj[pKey] = tmpString;
            tmpObj['page'] = 1;
            router.push({query: tmpObj});
        },

        /**
         * Для параметра с единственным значением
         * @param pKey
         * @param val
         */
        setParam: function(pKey, val) {
            var tmpObj = this.getRouteQuery();
            tmpObj[pKey] = val;
            tmpObj['page'] = 1;

            router.replace({query: tmpObj});
        },

        getRouteQuery: function () {
            var tmp = {};

            for (var key in this.$route.query) {
                if (this.$route.query.hasOwnProperty(key)) {
                    tmp[key] = this.$route.query[key];
                }
            }

            return tmp;
        }
    }
});