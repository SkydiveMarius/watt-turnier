function TeamRepository() 
{
    /**
     * @param {Team} team
     */
    this.add = function (team) 
    {
        $.ajax({
            method: 'POST',
            url: '/api/teams',
            data: JSON.stringify(team),
            success: function () {
                location.reload();
            }
        })
    };

    /**
     * @param {int} id
     * @param {function} callback
     */
    this.getById = function (id, callback)
    {
        $.ajax({
            method: 'GET',
            url: '/api/teams/' + id,
            success: function (data) {
                callback(new Team(data.id, data.firstPlayer, data.secondPlayer));
            }
        })
    }
}