<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "results".
 *
 * @property string $team1
 * @property string $team2
 * @property int $res1
 * @property int $res2
 * @property int $tour
 */
class Results extends ActiveRecord
{
    public static function tableName()
    {
        return 'results';
    }

    public function fields()
    {
        return [

//            'home' => 'team1',
//            'guest' => 'team2',
            'result' => function () {
                return $this->team1 . ' - ' . $this->team2 . ' - ' . $this->res1 . ':' .$this->res2;
            },
//            'points_home' => function () {
//                return ($this->res2 < $this->res1) ? 3 : ($this->res2 > $this->res1 ? 0 : 1);
//            },
//            'points_guest' => function () {
//                return $this->res2 > $this->res1 ? 3 : ($this->res2 < $this->res1 ? 0 : 1);
//            },
        ];
    }

    function baseSortQuery($row1, $row2) {
        return Results::find()
                ->filterWhere(['team1' => $row1['team']])
                ->orFilterWhere(['team2' => $row1['team']])
                ->orFilterWhere(['team1' => $row2['team']])
                ->orFilterWhere(['team2' => $row2['team']])
                ->andFilterWhere(['tour' => \Yii::$app->request->get('tour')])
                ->asArray()->all();
    }

    function sortRule1(array $rows, $a, $b) {
        $points_a = 0;
        $points_b = 0;
        foreach ($rows as $row) {
            if (in_array($a['team'], $row) && in_array($b['team'], $row)) {
                if ($row['res1'] == $row['res2']) {
                    continue;
                } else {
                    $tempRes = [
                        $row['team1'] => $row['res1'],
                        $row['team2'] => $row['res2'],
                    ];
                    if ($tempRes[$a['team']] > $tempRes[$b['team']]){
                        $points_a += 3;
                    } else {
                        $points_b += 3;
                    }
                }
            }
        }
        return $points_a > $points_b ? -1 : ($points_a < $points_b ? 1 : '');
    }

    function sortRule2(array $rows, $a, $b) {
        $goals_a = 0;
        $goals_b = 0;
        foreach ($rows as $row) {
            if (in_array($a['team'], $row) && in_array($b['team'], $row)) {
                if ($row['res1'] == $row['res2']) {
                    continue;
                } else {
                    $tempRes = [
                        $row['team1'] => $row['res1'],
                        $row['team2'] => $row['res2'],
                    ];
                    $goals_a += $tempRes[$a['team']];
                    $goals_b += $tempRes[$b['team']];
                }
            }
        }
        return $goals_a > $goals_b ? -1 : ($goals_a < $goals_b ? 1 : '');
    }

    function sortRule3(array $rows, $a, $b) {
        $diff_a = 0;
        $diff_b = 0;
        foreach ($rows as $row) {
            if (in_array($a['team'], $row) && in_array($b['team'], $row)) continue; // other functions

            $tempRes = [
                $row['team1'] => $row['res1'] - $row['res2'],
                $row['team2'] => $row['res2'] - $row['res1'],
            ];

            if (array_key_exists($a['team'], $tempRes)) {
                $diff_a += $tempRes[$a['team']];
            }
            if (array_key_exists($b['team'], $tempRes)) {
                $diff_b += $tempRes[$b['team']];
            }
        }
        return $diff_a > $diff_b ? -1 : ($diff_a < $diff_b ? 1 : '');
    }

    function sortRule4(array $rows, $a, $b) {
        $goals_a = 0;
        $goals_b = 0;
        foreach ($rows as $row) {
            if (in_array($a['team'], $row) && in_array($b['team'], $row)) continue; // other functions

            $tempRes = [
                $row['team1'] => $row['res1'],
                $row['team2'] => $row['res2'],
            ];

            if (array_key_exists($a['team'], $tempRes)) {
                $goals_a += $tempRes[$a['team']];
            }
            if (array_key_exists($b['team'], $tempRes)) {
                $goals_b += $tempRes[$b['team']];
            }
        }
        return $goals_a > $goals_b ? -1 : ($goals_a < $goals_b ? 1 : '');
    }

    function sortRules($a, $b) {
        if ($a['sum_points'] == $b['sum_points']) {

            $baseQuery = $this->baseSortQuery($a, $b);

            $rule = 0;
            $countRule = 1;
            $ruleName = 'sortRule';

            while (method_exists(Results::class, $ruleName.$countRule)) {
                $rule = $this->{$ruleName.$countRule}($baseQuery, $a, $b);
                if (!empty($rule)){
                    return $rule;
                }
                $countRule++;
             }
        }
    }

    public function tabletour($tour = null) {
        $filterWhere = '';
        if (!empty($tour) && is_numeric($tour)) {
            $filterWhere = "where tour between 1 and {$tour}";
        }
        $sql_res = "SELECT *, 
                        CASE
                            WHEN res1 = res2 
                                THEN 1
                            WHEN res1 > res2 
                                THEN 3
                            WHEN res1 < res2 
                                THEN 0
                        END AS team1_points, 
                        CASE
                            WHEN res1 = res2 
                                THEN 1
                            WHEN res1 > res2 
                                THEN 0
                            WHEN res1 < res2 
                                THEN 3
                        END AS team2_points
                    FROM results
                    {$filterWhere}";

        $sql_homesum = "SELECT res.team1 AS team, sum(res.team1_points) as sum_points
                        FROM ({$sql_res}) as res
                        GROUP BY res.team1";
        $sql_guestsum = "SELECT res.team2 AS team, sum(res.team2_points) as sum_points
                        FROM ({$sql_res}) as res
                        GROUP BY res.team2";

        $sql_union = "{$sql_homesum} union all {$sql_guestsum}";

        $query = \Yii::$app->db->createCommand(
            "select rs.team, SUM(rs.sum_points) AS sum_points from ({$sql_union}) as rs GROUP BY rs.team ORDER BY sum_points DESC"
         )->queryAll();

        usort($query, [self::class, "sortRules"]);

        return $query;
    }

}
