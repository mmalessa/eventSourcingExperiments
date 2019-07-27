<?php
namespace App\Domain\Budget;

use App\Domain\Budget\Event\BudgetWasCreated;
use App\Domain\EventSourcing\AggregateRoot;
use App\Domain\EventSourcing\AggregateRootInterface;
use App\Domain\EventSourcing\AggregeteRootId;

class Budget extends AggregateRoot implements AggregateRootInterface
{
    private $budgetId;
    private function __construct()
    {}

    public function create(AggregeteRootId $budgetId)
    {
        $budget = new self();
        $budget->budgetId = $budgetId;
        $budget->apply(new BudgetWasCreated($budgetId));
        return $budget;
    }

    protected function applyBudgetWasCreated(BudgetWasCreated $event)
    {
        $this->budgetId = $event->getBudgetId();
    }
}
