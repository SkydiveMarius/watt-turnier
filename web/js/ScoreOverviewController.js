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

    /**
     * @type {GameScoreRepository}
     */
    this.scoreRepository = undefined;

    /**
     * @type {int}
     */
    this.round = undefined;

    /**
     * @type {int}
     */
    this.selectedTable = undefined;

    this.init = function ()
    {
        this.modal = $('#scoreAddModal');
        this.teamRepository = new TeamRepository();
        this.scoreRepository = new GameScoreRepository();
    };

    /**
     * @param {int} roundId
     * @param {int} tableId
     */
    this.showModal = function (roundId, tableId)
    {
        this.modal.modal('show');
        this.round = roundId;
        this.selectedTable = tableId;
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
    };

    this.submitScores = function ()
    {
        this.modal.find('.create.button').addClass('loading');

        var score = new GameScore(
            this.round,
            this.selectedTable,
            parseInt(this.modal.find('.team-a-id input').val()),
            parseInt(this.modal.find('.team-b-id input').val()),
            [
                new Set(
                    parseInt(this.modal.find('.set-a-1 input').val()),
                    parseInt(this.modal.find('.set-b-1 input').val())
                ),
                new Set(
                    parseInt(this.modal.find('.set-a-2 input').val()),
                    parseInt(this.modal.find('.set-b-2 input').val())
                ),
                new Set(
                    parseInt(this.modal.find('.set-a-3 input').val()),
                    parseInt(this.modal.find('.set-b-3 input').val())
                )
            ]
        );
        console.log(score);

        this.scoreRepository.submit(score, function () {
            location.reload();
        })
    };

    /**
     * @param {*} button
     * @param {number} roundId
     * @param {number} tableId
     */
    this.resetScores = function (button, roundId, tableId)
    {
        $(button).addClass('loading');
        this.scoreRepository.delete(roundId, tableId, function () {
            location.reload();
        })
    }
}