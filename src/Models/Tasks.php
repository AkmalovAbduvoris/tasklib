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

  // public function getTaskById($id): array {
  //   $stmt = $this->pdo->prepare("
  //   SELECT *,
  //     tasks.title AS task_title,
  //     requirements.title AS requirement_title,
  //     required_knowledge.title AS knowledge_title
  //   FROM tasks
  //   INNER JOIN requirements ON tasks.id = requirements.task_id
  //   INNER JOIN required_knowledge ON tasks.id = required_knowledge.task_id
  //   WHERE tasks.id = :id");
  //   $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
  //   $stmt->execute();
    
  //   return $stmt->fetchAll();
  // }
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
    WHERE tasks.id = :id");
    
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
            'requirements' => [],
            'knowledge' => []
        ];

        $addedKnowledge = [];

        foreach ($rows as $row) {

          if ($row['requirement_title']) {
                $taskData['requirements'][] = [
                    'requirement_title' => $row['requirement_title'],
                    'requirement_resourse' => $row['requirement_resourse']
                ];
            }

            // Add knowledge to the array, but avoid duplicates
            if ($row['knowledge_title'] && !in_array($row['knowledge_title'], $addedKnowledge)) {
                $taskData['knowledge'][] = [
                    'knowledge_title' => $row['knowledge_title'],
                    'knowledge_resourse' => $row['knowledge_resourse']
                ];
                // Mark this knowledge as added
                $addedKnowledge[] = $row['knowledge_title'];
            }
        }

        return $taskData;
    }

    return [];
}



}
