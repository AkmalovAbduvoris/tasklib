<?php
declare(strict_types=1);

namespace App\Models;

class Tasks {
  public \PDO $pdo;

  public function __construct() {
    $this->pdo = \App\Models\DB::getConnection();
  }

  public function getAllTasks(): array {
    $stmt = $this->pdo->query("SELECT * FROM tasks WHERE status = 'published'");
    return $stmt->fetchAll();
  }
  
  public function addTask($title, $description, $status, $difficulty, $deadline, $requirements_titles = [], $requirements_resourse = [], $knowledges_titles = [], $knowledges_resourse = []) {
    $stmt = $this->pdo->prepare("INSERT INTO tasks (title, description, status, difficulty, deadline) VALUES (:title, :description, :status, :difficulty, :deadline);");
    $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, \PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, \PDO::PARAM_STR);
    $stmt->bindParam(':difficulty', $difficulty, \PDO::PARAM_STR);
    $stmt->bindParam(':deadline', $deadline, \PDO::PARAM_INT);
    $stmt->execute();
    $taskId = $this->pdo->lastInsertId();

    if (!empty($requirements_titles) && !empty($requirements_resourse)) {
      $reqStmt = $this->pdo->prepare("INSERT INTO requirements (task_id, title, resourse) VALUES(:task_id, :title, :resourse);");
      foreach ($requirements_titles as $key => $title) {
        $reqStmt->bindParam(':task_id', $taskId, \PDO::PARAM_INT);
        $reqStmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $reqStmt->bindParam(':resourse', $requirements_resourse[$key], \PDO::PARAM_STR);
        $reqStmt->execute();
      }
    }
    if (!empty($knowledges_titles) && !empty($knowledges_resourse)) {
      $knowStmt = $this->pdo->prepare("INSERT INTO required_knowledge (task_id, title, resourse) VALUES(:task_id, :title, :resourse);");
      foreach ($requirements_titles as $key => $title) {
        $knowStmt->bindParam(':task_id', $taskId, \PDO::PARAM_INT);
        $knowStmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $knowStmt->bindParam(':resourse', $knowledges_resourse[$key], \PDO::PARAM_STR);
        $knowStmt->execute();
      }
    }
  }

  public function getTaskById($id): array {
    $stmt = $this->pdo->prepare("
    SELECT 
        tasks.id AS task_id,
        tasks.title AS task_title,
        tasks.description AS task_description,
        tasks.status AS task_status,
        tasks.difficulty AS task_difficulty,
        tasks.deadline AS task_deadline,
        tasks.created_at AS task_created_at,
        tasks.updated_at AS task_updated_at,
        requirements.title AS requirement_title,
        requirements.resourse AS requirement_resourse,
        required_knowledge.title AS knowledge_title,
        required_knowledge.resourse AS knowledge_resourse
    FROM tasks
    LEFT JOIN requirements ON tasks.id = requirements.task_id
    LEFT JOIN required_knowledge ON tasks.id = required_knowledge.task_id
    WHERE tasks.id = :id
    ");
    
    $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();

    $rows = $stmt->fetchAll();

    if ($rows) {
        // Task data initialization
        $taskData = [
            'task_id' => $rows[0]['task_id'],
            'task_title' => $rows[0]['task_title'],
            'task_description' => $rows[0]['task_description'],
            'task_status' => $rows[0]['task_status'],
            'task_difficulty' => $rows[0]['task_difficulty'],
            'task_deadline' => $rows[0]['task_deadline'],
            'task_created_at' => $rows[0]['task_created_at'],
            'task_updated_at' => $rows[0]['task_updated_at'],
            'requirements' => [], // requirements massivini bosh qilib boshlaymiz
            'knowledge' => [] // knowledge massivini bosh qilib boshlaymiz
        ];

        // Bu yerda knowledge uchun qayta ishlash
        $addedKnowledge = [];

        foreach ($rows as $row) {
            // Requirements bo'lsa qo'shamiz
            if ($row['requirement_title']) {
                $taskData['requirements'][] = [
                    'requirement_title' => $row['requirement_title'],
                    'requirement_resourse' => $row['requirement_resourse']
                ];
            }

            // Knowledge bo'lsa va duplikat bo'lmasa qo'shamiz
            if ($row['knowledge_title'] && !in_array($row['knowledge_title'], $addedKnowledge)) {
                $taskData['knowledge'][] = [
                    'knowledge_title' => $row['knowledge_title'],
                    'knowledge_resourse' => $row['knowledge_resourse']
                ];
                $addedKnowledge[] = $row['knowledge_title']; // Bu knowledge qo'shilganini belgilash
            }
        }
        return $taskData;
    }
    return []; // Agar ma'lumotlar bo'lmasa bo'sh massivni qaytaramiz
  }
}
