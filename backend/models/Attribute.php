<?php
namespace App\Models;

abstract class Attribute {
    protected $id;
    protected $name;
    protected $value;

    public function __construct($id, $name, $value) {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

    abstract public function getType();
}

class SizeAttribute extends Attribute {
    public function getType() {
        return 'size';
    }
}

class ColorAttribute extends Attribute {
    public function getType() {
        return 'color';
    }
}

class MaterialAttribute extends Attribute {
    public function getType() {
        return 'material';
    }
}