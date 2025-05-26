<?php
class Transaction extends Model {
    protected $fillable = ['user_id', 'type', 'amount', 'description'];
}

// app/Models/Saving.php
class Saving extends Model {
    protected $fillable = ['user_id', 'name', 'target', 'current_amount', 'frequency', 'amount_per_cycle'];
}
