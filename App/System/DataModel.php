<?php

namespace Ti\Helpdesk\App\System;
use App\http\Database;
use PDO;

class DataModel
{
    protected $paginate = false;
    protected $limit = false;
    protected $cascade = false;
    protected $action = NULL;
    public $pivot_entity = NULL;
    public $pivot_parent_id = NULL;
    public $pivot_table = NULL;
    public $created_at = NULL;
    public $update_at = NULL;

    public function getPDOConnection()
    {
        return (new DatabaseConnection())->run();
    }

    //crud methods
    public function save()
    {
        $fields = NULL;
        $values = NULL;
        foreach ($this->fields as $key => $field)
        {
            if(count($this->fields) != $key+1)
            {
                $fields = $fields.$field.',';
                $values = $values.'?,';
            } else {
                $fields = $fields.$field;
                $values = $values.'?';
            }
        }
        $db = $this->getPDOConnection();
        $sql = 'INSERT INTO '.$this->table.' ('.$fields.') VALUES ('.$values.')';
        $stmt = $db->prepare($sql);
        foreach ($this->fields as $key => $field)
        {
            $stmt->bindValue($key+1, $this->$field);
        }
        $stmt->execute();
        $_SESSION['PARAMETER'] = $db->lastInsertId();
    }

    public function find($id)
    {
        $db = $this->getPDOConnection();
        $sql = 'SELECT * FROM '.$this->table.' WHERE id='.$id;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $register = $stmt->fetch();
        return $this->createObject($register, static::class);
    }
    public function rowCount()
    {
        $db = $this->getPDOConnection();
        $sql = 'SELECT COUNT(*) as totalva FROM '.$this->table;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $register = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->createObject($register, static::class);
    }

    public function rowWhereCount($columName,$dcondition)
    {
        $db = $this->getPDOConnection();
        $sql = 'SELECT COUNT(*) as totaldata FROM '.$this->table.' WHERE '.$columName.'='.$dcondition;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $register = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($register as $totald){
            return $totald['totaldata'];
        }

    }


    public function writeFields()
    {
        $fields = NULL;
        foreach ($this->fields as $key => $field)
        {
            if(count($this->fields) != $key+1)
            {
                $fields = $fields.' '.$field.'= :'.$field.',';
            } else {
                $fields = $fields.' '.$field.'= :'.$field;
            }
        }
        return $fields;
    }

    public function update(array $updates)
    {
        $i = 0;
        foreach ($updates as $field => $update)
        {
            $i++;
            if(count($updates) != $i)
            {
                $fields = $field.' '.$field.'= :'.$field.',';
            } else {
                $fields = $field.' '.$field.'= :'.$field;
            }
        }
        $db = $this->getPDOConnection();
        $sql = 'UPDATE '.$this->table.' SET '.$fields.' WHERE id="'.$this->id.'"';
        $stmt = $db->prepare($sql);
        foreach ($updates as $field => $update)
        {
            $stmt->bindValue(':'.$field, $update);
        }
        $stmt->execute();
    }

    public function all($is_deleted=0)
    {
        $sql = 'SELECT * FROM '.$this->table.$this->verifySoftDelete($is_deleted).' ORDER BY id DESC';
        $db = $this->getPDOConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $registers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($this->paginate)
        {
            $this->setPagination($registers);
            $sql = 'SELECT * FROM '.$this->table.$this->verifySoftDelete($is_deleted).' LIMIT '.$this->getLimit();
            if($_SESSION['PAGE'] > 1)
            {
                $sql = $sql.' OFFSET '.($_SESSION['PAGE'] - 1)*$this->getLimit();
            }
            $_SESSION['PAGINATE'] = true;
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $registers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $_SESSION['PAGINATE'] = false;
        }
        return $this->objectsConstruct($registers, $this->getNameOfClass());
    }
    public function get($is_deleted=0)
    {
        $sql = 'SELECT * FROM '.$this->table.$this->verifySoftDelete($is_deleted);
        $db = $this->getPDOConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $registers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($this->paginate)
        {
            $this->setPagination($registers);
            $sql = 'SELECT * FROM '.$this->table.$this->verifySoftDelete($is_deleted).' LIMIT '.$this->getLimit();
            if($_SESSION['PAGE'] > 1)
            {
                $sql = $sql.' OFFSET '.($_SESSION['PAGE'] - 1)*$this->getLimit();
            }
            $_SESSION['PAGINATE'] = true;
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $registers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $_SESSION['PAGINATE'] = false;
        }
        return $this->objectsConstruct($registers, $this->getNameOfClass());
    }

    public function all_deleted($is_deleted)
    {
        return $this->all($is_deleted);
    }

    public function verifySoftDelete($level)
    {
        return property_exists($this->getNameOfClass(), 'is_deleted') ? ' WHERE is_deleted="'.$level.'"' : '';
    }

    public function where($condition)
    {
        $db = $this->getPDOConnection();
        $sql = 'SELECT * FROM '.$this->table.' WHERE '.$condition;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $registers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($this->paginate)
        {
            $this->setPagination($registers);
            if($_SESSION['PAGE'] > 1)
            {
                $sql = $sql.' OFFSET '.($_SESSION['PAGE'] - 1)*$this->getLimit();
            }
            $_SESSION['PAGINATE'] = true;
            $stmt = $this->getStmt($sql);
            $stmt->execute();
            $registers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $_SESSION['PAGINATE'] = false;
        }
        return $this->objectsConstruct($registers, static::class);
    }

    public function wherec($id_con,$condition)
    {
        $db = $this->getPDOConnection();
        $sql = 'SELECT * FROM '.$this->table.' WHERE '.$id_con.'='.$condition;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $registers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($this->paginate)
        {
            $this->setPagination($registers);
            if($_SESSION['PAGE'] > 1)
            {
                $sql = $sql.' OFFSET '.($_SESSION['PAGE'] - 1)*$this->getLimit();
            }
            $_SESSION['PAGINATE'] = true;
            $stmt = $this->getStmt($sql);
            $stmt->execute();
            $registers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $_SESSION['PAGINATE'] = false;
        }
        return $this->objectsConstruct($registers, static::class);
    }


    public function delete($id)
    {
        $db = $this->getPDOConnection();
        $sql = 'DELETE FROM '.$this->table.' WHERE id="'.$id.'"';
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }

    public function pvdelete($id_colum,$id)
    {
        $db = $this->getPDOConnection();
        $sql = 'DELETE FROM '.$this->table.' WHERE '.$id_colum.'='.'"'.$id.'"';
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }


    public function softDelete()
    {
        $db = $this->getPDOConnection();
        $sql = 'UPDATE '.$this->table.' SET is_deleted=:is_deleted WHERE id="'.$this->id.'"';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':is_deleted', '1');
        $stmt->execute();
    }

    public function restore()
    {
        $db = $this->getPDOConnection();
        $sql = 'UPDATE '.$this->table.' SET is_deleted=:is_deleted WHERE id="'.$this->id.'"';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':is_deleted', '0');
        $stmt->execute();
    }

    //pagination methods
    public function setPagination($registers)
    {
        $_SESSION['PAGES_NUMBER'] = count($registers) / $this->getLimit();
    }

    public function paginate($limit)
    {
        $this->paginate = true;
        $this->limit = $limit;
        return $this;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function getNameOfClass()
    {
        return static::class;
    }

    //construct methods
    public function createObject($register, $class_name)
    {
        if(!$register)
        {
            return NULL;
        } else {
            $obj = new $class_name;
            foreach ($register as $key => $value)
            {
                $obj->$key = $value;
            }
            return $obj;
        }
    }

    public function objectsConstruct($registers, $class_name)
    {
        $objects = [];
        if(!empty($registers))
        {
            foreach ($registers as $register)
            {
                array_push($objects, $this->createObject($register, $class_name));
            }
        }
        return $objects;
    }

    //relationship methods
    public function hasMany($entity, $parent_id)
    {
        $db = $this->getPDOConnection();
        $sql = 'SELECT * FROM '.$entity->table.' WHERE '.$parent_id.'='.$this->id;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $registers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->objectsConstruct($registers, $entity->getNameOfClass());
    }

    public function belongsTo($entity, $parent_id)
    {
        $db = $this->getPDOConnection();
        $sql = 'SELECT * FROM '.$entity->table.' WHERE id='.$this->$parent_id;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $registers = $stmt->fetch();
        return $this->createObject($registers, $entity->getNameOfClass());
    }

    public function hasOne($entity, $parent_id)
    {
        $db = $this->getPDOConnection();
        $sql = 'SELECT * FROM '.$entity->table.' WHERE id='.$this->$parent_id;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $registers = $stmt->fetch();
        return $this->createObject($registers, $entity->getNameOfClass());
    }

    //pivot
    public function setPivot($pivot_entity, $pivot_parent_id, $parent_table)
    {
        $pivot_params = [];
        $pivot_params['entity'] = $pivot_entity->getNameOfClass();
        $pivot_params['table'] = $pivot_entity->table;
        $pivot_params['parent_id'] = $pivot_parent_id;
        $pivot_params['parent_table'] = $parent_table;
        $_SESSION['PIVOT_PARAMS'] = $pivot_params;
    }

    public function findPivot($pivot_entity_name, $pivot_table, $pivot_parent_id, $parent_table, $value)
    {
        $db = $this->getPDOConnection();
        $sql = 'SELECT pivot.id FROM '.$pivot_table.' AS pivot INNER JOIN '.$parent_table.' AS parent ON pivot.'.$pivot_parent_id.'=parent.id';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $register = $stmt->fetch();
        $obj = $this->createObject($register, $pivot_entity_name);
        $obj->pivot_entity = $pivot_entity_name;
        $obj->pivot_parent_id = $pivot_parent_id;
        $obj->pivot_table = $pivot_table;
        return $obj;
    }

    public function findBy($conditions)
    {
        $db = $this->getPDOConnection();
        $sql = 'SELECT * FROM '.$this->table.' WHERE '.$conditions;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $register = $stmt->fetch();
        return $this->createObject($register, static::class);
    }

    public function pivot()
    {
        $pivot_params = $_SESSION['PIVOT_PARAMS'];
        $pivot_entity_name = $pivot_params['entity'];
        return $this->findPivot($pivot_entity_name, $pivot_params['table'], $pivot_params['parent_id'], $pivot_params['parent_table'], $this->id);
    }

    public function belongsToMany($entity, $pivot_entity, $parent_id_a, $parent_id_b)
    {
        $this->setPivot($pivot_entity, $parent_id_a, $this->table);
        $fields = NULL;
        foreach ($entity->fields as $key => $field)
        {
            if(count($entity->fields) == $key+1)
            {
                $fields = $fields.''.$field;
            } else {
                $fields = $fields.' '.$field.', ';
            }
        }
        $db = $this->getPDOConnection();
        $sql = 'SELECT '.$entity->table.'.id, '.$fields.' FROM '.$entity->table.' RIGHT JOIN '.$pivot_entity->table.' AS pivot ON pivot.'.$parent_id_a.'='.$this->id.' AND pivot.'.$parent_id_b.'='.$entity->table.'.id WHERE '.$entity->table.'.id IS NOT NULL';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $registers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $object = $this->objectsConstruct($registers, $entity->getNameOfClass());
        return $object;
    }

    //auxiliares
    public function writeParents($relationMethods, $attr)
    {
        $content = null;
        if($this->$relationMethods() != null)
        {
            foreach ($this->$relationMethods() as $key => $register) {
                if(count($this->$relationMethods()) == 1 || count($this->$relationMethods()) == $key-1)
                    $content = $content.$register->$attr;
                else
                    $content = $content.$register->$attr.', ';
            }
        } else {
            return '(None)';
        }
        return $content;
    }

    public function seeInDatabase($table, $fields)
    {
        $conditions = '';
        $first = false;
        foreach ($fields as $field => $value)
        {
            if($first == false)
            {
                $first = true;
                $conditions = $field.'="'.$value.'"';
            } else {
                $conditions = $conditions.' AND '.$field.'="'.$value.'"';
            }
        }
        $db = $this->getPDOConnection();
        $sql = 'SELECT * FROM '.$table.' WHERE '.$conditions;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $register = $stmt->fetch();
        return $this->createObject($register, static::class);
    }
}