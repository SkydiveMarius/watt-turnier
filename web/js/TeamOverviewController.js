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

    /**
     * @type {string}
     */
    this.modalAction = undefined;

    /**
     * @type {Team}
     */
    this.selectedTeam = undefined;

    this.init = function ()
    {
        this.modal = $('#playerAddModal');
        this.repository = new TeamRepository();
    };

    this.showModal = function ()
    {
        this.modalAction = 'create';
        this.modal.modal('show');
    };

    this.createTeam = function ()
    {
        this.modal.find('.create.button').addClass('loading');
        var firstPlayer = $('#firstPlayerInput').val();
        var secondPlayer = $('#secondPlayerInput').val();

        if (this.modalAction === 'create') {
            this.selectedTeam = new Team(0, firstPlayer, secondPlayer);
            this.repository.add(this.selectedTeam);
        } else {
            this.selectedTeam.firstPlayer = firstPlayer;
            this.selectedTeam.secondPlayer = secondPlayer;
            this.repository.update(this.selectedTeam, function () {
                location.reload();
            })
        }
    };

    /**
     * @param {int} teamId
     */
    this.showModalWithPlayer = function (teamId)
    {
        this.modalAction = 'update';
        this.repository.getById(teamId, function (team) {
            app.TeamOverviewController.selectedTeam = team;
            $('#firstPlayerInput').val(team.firstPlayer);
            $('#secondPlayerInput').val(team.secondPlayer);
        });
        this.modal.modal('show');
    }
}