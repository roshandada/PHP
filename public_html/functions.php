<?php
function insert( $table, $record) {
    global $pdo;
    $keys = array_keys($record);

    $values = implode(', ', $keys);
    $valuesWithColon = implode(', :', $keys);

    $query = 'INSERT INTO ' . $table . ' (' .$values. ') VALUES (:' .$valuesWithColon. ')';

    $stmt = $pdo->prepare($query);

    $stmt->execute($record);
}
function update($table, $record, $pk){
    global $pdo;
    $parameters = [];
    foreach ($record as $key => $value) {
        $parameters[]= $key . '= :'. $key;
    }
    $parametersWithComma= implode(',', $parameters);
    $query = "UPDATE $table SET $parametersWithComma WHERE $pk = :pk";
    $record['pk'] = $record['pk'];
    $stmt = $pdo->prepare($query);
    $stmt->execute($record);
}
function find( $table, $field, $value) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM ' . $table . ' WHERE ' . $field . ' = :value');
        $criteria = [
                'value' => $value
        ];
        $stmt->execute($criteria);

        return $stmt;
}

function findAll( $table) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM ' . $table );

        $stmt->execute();

        return $stmt;
}

function delete($table,$field, $value){
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM $table WHERE $field =:pk" );
        $criteria =[
            'pk' => $value
        ];
        $stmt->execute($criteria);
        return $stmt;
}

