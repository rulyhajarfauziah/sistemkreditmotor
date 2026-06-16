<?php
function hitung_knn($conn, $data_baru, $k = 3) {
    $query = "SELECT * FROM data_training";
    $result = mysqli_query($conn, $query);
    
    $dataset = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dataset[] = $row;
        }
    }

    if (empty($dataset)) {
        return 'Tidak Layak'; 
    }

    $all_p = array_column($dataset, 'penghasilan');
    $all_u = array_column($dataset, 'uang_muka');
    $all_t = array_column($dataset, 'tenor');
    
    $min_p = min($all_p); $max_p = max($all_p);
    $min_u = min($all_u); $max_u = max($all_u);
    $min_t = min($all_t); $max_t = max($all_t);

    $norm_new_p = ($max_p - $min_p) == 0 ? 0 : ($data_baru['penghasilan'] - $min_p) / ($max_p - $min_p);
    $norm_new_u = ($max_u - $min_u) == 0 ? 0 : ($data_baru['uang_muka'] - $min_u) / ($max_u - $min_u);
    $norm_new_t = ($max_t - $min_t) == 0 ? 0 : ($data_baru['tenor'] - $min_t) / ($max_t - $min_t);

    $list_jarak = [];

    foreach ($dataset as $data) {
        $norm_train_p = ($max_p - $min_p) == 0 ? 0 : ($data['penghasilan'] - $min_p) / ($max_p - $min_p);
        $norm_train_u = ($max_u - $min_u) == 0 ? 0 : ($data['uang_muka'] - $min_u) / ($max_u - $min_u);
        $norm_train_t = ($max_t - $min_t) == 0 ? 0 : ($data['tenor'] - $min_t) / ($max_t - $min_t);

        $v1 = pow($norm_new_p - $norm_train_p, 2);
        $v2 = pow($norm_new_u - $norm_train_u, 2);
        $v3 = pow($norm_new_t - $norm_train_t, 2);
        $v4 = pow($data_baru['pekerjaan'] - $data['pekerjaan'], 2);
        $v5 = pow($data_baru['rumah'] - $data['rumah'], 2);

        $jarak = sqrt($v1 + $v2 + $v3 + $v4 + $v5);

        $list_jarak[] = [
            'keputusan' => $data['keputusan'],
            'jarak'     => $jarak
        ];
    }

    usort($list_jarak, function($a, $b) { 
        return $a['jarak'] <=> $b['jarak']; 
    });

    $tetangga = array_slice($list_jarak, 0, $k);

    $voted = ['Layak' => 0, 'Tidak Layak' => 0];
    foreach ($tetangga as $t) {
        $voted[$t['keputusan']]++;
    }

    return ($voted['Layak'] >= $voted['Tidak Layak']) ? 'Layak' : 'Tidak Layak';
}
?>
