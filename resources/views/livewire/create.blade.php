<div>
    <div class="form-group">
        <label for="exampleInputPassword1">Enter nom</label>
        <input type="text" wire:model="nom" class="form-control input-sm"  placeholder="nom">
    </div>
    <div class="form-group">
        <label>Enter nbrEmployes</label>
        <input type="number" class="form-control input-sm" placeholder="Enter nbrEmployes" wire:model="nbrEmployes">
    </div>
    <div class="form-group">
        <label>Enter capitale</label>
        <input type="number" class="form-control input-sm" placeholder="Enter capitale" wire:model="capitale">
    </div>
    <button wire:click="store()" class="btn btn-primary">Submit</button>
</div>
