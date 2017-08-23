function TeamOverviewController()
{
    /**
     * @type {*}
     */
    this.modal = undefined;

    /**
     * @type {TeamRepository}
     */
    this.repository = undefined;

    this.init = function ()
    {
        this.modal = $('#playerAddModal');
        this.repository = new TeamRepository();
    };

    this.showModal = function ()
    {
        this.modal.modal('show');
    };

    this.createTeam = function ()
    {
        this.modal.find('.create.button').addClass('loading');
        var team = new Team(0, $('#firstPlayerInput').val(), $('#secondPlayerInput').val());
        this.repository.add(team);
    }
}