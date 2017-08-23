function ScoreOverviewController()
{
    /**
     * @type {*}
     */
    this.modal = undefined;

    this.init = function ()
    {
        this.modal = $('#scoreAddModal');
    };

    /**
     * @param {int} roundId
     * @param {int} tableId
     */
    this.showModal = function (roundId, tableId)
    {
        this.modal.modal('show');
    }
}