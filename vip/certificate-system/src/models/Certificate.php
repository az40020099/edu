<?php

class Certificate {
    private $id;
    private $name;
    private $template;
    private $dateIssued;
    private $userId;

    public function __construct($name, $template, $userId) {
        $this->name = $name;
        $this->template = $template;
        $this->userId = $userId;
        $this->dateIssued = date("Y-m-d H:i:s");
    }

    public function saveToDatabase($conn) {
        $stmt = $conn->prepare("INSERT INTO certificates (name, template, date_issued, user_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $this->name, $this->template, $this->dateIssued, $this->userId);
        $stmt->execute();
        $this->id = $stmt->insert_id;
        $stmt->close();
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getTemplate() {
        return $this->template;
    }

    public function getDateIssued() {
        return $this->dateIssued;
    }

    public function getUserId() {
        return $this->userId;
    }
}
