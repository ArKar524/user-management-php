<?php
trait Model
{
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = 'desc';
    protected $order_by = 'id';


    public function all()
    {
        $query = "select * from $this->table order by $this->order_by $this->order_type limit $this->limit offset $this->offset";
        return $this->query($query);
    }

    public function find($value, $column = 'id')
    {
        $query = "SELECT * FROM $this->table WHERE $column = :value";
        return $this->get_row($query, [':value' => $value]);
    }


    public function where($data, $data_not = [])
    {

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }
        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }
        $query = trim($query, " && ");
        $query .= " order by $this->order_by $this->order_type limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);
        return $this->query($query, $data);
    }
    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }
        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }
        $query = trim($query, " && ");
        $query .= " order by $this->order_by $this->order_type limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);
        if ($result) {
            return $result[0];
        }
        return false;
    }

    public function insert($data)
    {
        // remove unwanted data
        if (empty($this->allowedColumns)) {
            foreach ($data as $key => $val) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "insert into $this->table (" . implode(',', $keys) . ") values (:" . implode(',:', $keys) . ") ";
        $result = $this->query($query, $data);
        return $result;
    }

    public function update($id, $data, $id_column = 'id')
    {
        // remove unwanted data
        if (empty($this->allowedColumns)) {
            foreach ($data as $key => $val) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "update $this->table set ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }
        $query = trim($query, ", ");
        $query .= " where $id_column = :$id_column";
        $data[$id_column] = $id;
        // dd($query);
        $this->query($query, $data);
        return false;
    }

    public function delete($id, $id_column = 'id')
    {

        $data[$id_column] = $id;
        $query = "delete from $this->table where $id_column = :$id_column";
        // dd($query);
        $this->query($query, $data);
        return false;
    }

}