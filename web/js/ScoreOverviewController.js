function ScoreOverviewController()
{
    /**
     * @type {*}
     */
    this.modal = undefined;

    /**
     * @type {TeamRepository}
     */
    this.teamRepository = undefined;

    this.init = function ()
    {
        this.modal = $('#scoreAddModal');
        this.teamRepository = new TeamRepository();
    };

    /**
     * @param {int} roundId
     * @param {int} tableId
     */
    this.showModal = function (roundId, tableId)
    {
        this.modal.modal('show');
    };

    /**
     * @param {*} input
     * @param {string} teamLetter
     */
    this.loadTeamNames = function (input, teamLetter)
    {
        input = $(input);
        this.teamRepository.getById(input.val(), function (team) {
            app.ScoreOverviewController.modal.find('.team-' + teamLetter + '.first-player').html('<i class="user icon"></i>' + team.firstPlayer);
            app.ScoreOverviewController.modal.find('.team-' + teamLetter + '.second-player').html('<i class="user icon"></i>' + team.secondPlayer);
        })
    }
}