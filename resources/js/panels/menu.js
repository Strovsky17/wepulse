// Create WB Template
window.PanelMenu = function( $scope, __config )
{
    let _this = this;

    this.$scope = $scope;

    // Init the constructor
    this._construtor = function()
    {
        new Panel( this );
    }

    this.rules = {}

    this.actions = {

        // Open drop Menu
        open: ( f, $el ) => {
            $el.classList.toggle('open');            
        }
    }

    _this._construtor();
}