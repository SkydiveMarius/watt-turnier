function TeamOverviewController()
{
    /**
     * @type {*}
     */
    this.modal = undefined;

    this.init = function ()
    {
        this.modal = $('#playerAddModal');
    };

    this.showModal = function ()
    {
        this.modal.modal('show');
    }
}