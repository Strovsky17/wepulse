// Show user of the BO
window.PanelHistory = function( $scope, __config )
{
    let _this = this;

    this.$scope = $scope;

    // Init the constructor
    this._construtor = function()
    {
        new Panel( this );
        this.initTable();

        _this.parameters.__search = '';
    }

    this.rules = {
        
    }

    this.actions = { }

    this.process = () => {

        if( this.table != null )
        {
            this.table.$search.value = this.parameters.__search;
            this.table.search();
        }
    }

    // Initialize table
    this.initTable = () => {

        this.table = new SuperTable( document.querySelector('.table'),{
            rowsPerPage: 10,
            perPage: false,
            search: false,
            /*lang: {
                create: "{{__('table.create')}}",
                next: "{{__('table.next')}}",
                prev: "{{__('table.prev')}}",
                countPage: "{{__('table.countPage')}}",
                noResults: "{{__('table.noResults')}}",
                search: "{{__('table.search')}}"
            },*/

            columns: {
                equipment: __config.lang.equipment,
                category: __config.lang.category,
                register: __config.lang.register,
                date: __config.lang.date,
            },
            data: __config.data,
            actions:[
                { 'cls':'primary', 'icon':'thin fa-pen-to-square', label: '', callback: (d) => { 
                    alert('Ver User') 
                }},
                { 'cls':'primary', 'icon':'thin fa-trash-can', label: '', callback: (d) => { 
                    alert('Remove User') 
                }},
            ]
        });

    }

    _this._construtor();
}