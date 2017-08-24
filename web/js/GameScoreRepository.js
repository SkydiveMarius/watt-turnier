function GameScoreRepository()
{
    /**
     * @param {GameScore} score
     * @param {function} callback
     */
    this.submit = function (score, callback)
    {
        $.ajax({
            method: 'POST',
            url: '/api/scores',
            data: JSON.stringify(score),
            success: function () {
                callback();
            }
        })
    };

    /**
     * @param {int} roundId
     * @param {int} tableId
     * @param {function} callback
     */
    this.delete = function (roundId, tableId, callback)
    {
        $.ajax({
            method: 'DELETE',
            url: '/api/scores/round/' + roundId + '/table/' + tableId,
            success: function () {
                callback();
            }
        })
    }
}