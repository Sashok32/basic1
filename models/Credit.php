<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "credit".
 *
 * @property int $id
 * @property string $start_date
 * @property int $body_sum
 * @property int $month
 * @property int $rate
 * @property string $params
 * @property int $unique_id
 */
class Credit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'credit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_date', 'body_sum', 'month', 'rate'], 'required'],
            [['body_sum', 'month', 'rate'], 'integer'],
            [['start_date'], 'string'],
            [['params', 'unique_id'], 'safe'],
//            ['date', 'default', 'value' => date('Y-m-d H:i:s')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_date' => 'Начальная дата',
            'body_sum' => 'Сумма займа',
            'month' => 'Количество месяцев',
            'rate' => 'Годовая ставка (%)',
        ];
    }

    public function calculate() {
        $date = $this->start_date;
        $credit = $this->body_sum;
        $month = $this->month;
//        $k_rate = $this->rate/100;
        $avg_k_rate = $this->rate/(100*12);

        /* вычисляем ежемесячный платеж */
        $K = ($avg_k_rate * pow(1+$avg_k_rate, $month)) / (pow(1+$avg_k_rate, $month) - 1);
        $avg_month = $credit * $K;

        $result_table = [];

        /* вычисляем все платежи и заполняем таблицу */
        for ($i=1; $i <= $month; $i++) {
            $monthPercent = $avg_k_rate * $credit;
            $monthBody = $avg_month - $monthPercent;
            $credit -= $monthBody;
            $date = date('d-m-Y', strtotime($date . " + 1 month"));

            $result_table[] = [
                'num' => $i,
                'date' => $date,
                'month_base' => $this->toFloatTwo($avg_month),
                'month_percent' => $this->toFloatTwo($monthPercent),
                'month_body' => $this->toFloatTwo($monthBody),
                'leave_body' => $this->toFloatTwo($credit),
            ];
        }
        return json_encode($result_table);
    }

    private function toFloatTwo($num) {
        $num = round($num, 2);
        if (strpos($num, '-') === 0) {
            $num = substr($num, 1);
        }
        $flo = explode('.', $num);
        if (empty($flo[1])) {
            $num .= '.00';
        } elseif (strlen($flo[1]) == 1) {
            $num .= '0';
        }
        return $num;

    }
}
