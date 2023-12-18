<?php
// Клас, стан якого потрібно зберігати
class Originator {
    private $state;

    public function setState($state) {
        $this->state = $state;
    }

    public function getState() {
        return $this->state;
    }

    public function createMemento() {
        return new Memento($this->state);
    }

    public function restoreMemento(Memento $memento) {
        $this->state = $memento->getState();
    }
}

// Клас, що представляє знімок стану
class Memento {
    private $state;

    public function __construct($state) {
        $this->state = $state;
    }

    public function getState() {
        return $this->state;
    }
}

// Зберігач, який відповідає за зберігання та відновлення знімків
class Caretaker {
    private $mementos = [];

    public function addMemento(Memento $memento) {
        $this->mementos[] = $memento;
    }

    public function getMemento($index) {
        return $this->mementos[$index];
    }
}

// Використання паттерна Знімок
$originator = new Originator();
$caretaker = new Caretaker();

// Встановлення початкового стану та збереження знімка
$originator->setState("State 1");
$caretaker->addMemento($originator->createMemento());

// Зміна стану та збереження нового знімка
$originator->setState("State 2");
$caretaker->addMemento($originator->createMemento());

// Відновлення стану з раніше збереженого знімка
$originator->restoreMemento($caretaker->getMemento(0));

echo $originator->getState(); // Output: State 1

