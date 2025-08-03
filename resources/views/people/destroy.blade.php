<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
  
    <h2>supprimer un produit</h2>

    <p>Êtes-vous sûr de vouloir supprimer ce produit ?</p>

    <form action="{{ route('people.destroy', $person->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <a href="{{ route('people.index') }}" class="btn btn-secondary">Cancel</a>


</body>
</html>