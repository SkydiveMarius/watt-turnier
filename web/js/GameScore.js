/**
 * @param {int} round
 * @param {int} table
 * @param {int} teamA
 * @param {int} teamB
 * @param {Set[]} sets
 * @constructor
 */
function GameScore(round, table, teamA, teamB, sets)
{
    /**
     * @type {Number}
     */
    this.round = round;

    /**
     * @type {Number}
     */
    this.table = table;

    /**
     * @type {Number}
     */
    this.teamA = teamA;

    /**
     * @type {Number}
     */
    this.teamB = teamB;

    /**
     * @type {Set[]}
     */
    this.sets = sets
}