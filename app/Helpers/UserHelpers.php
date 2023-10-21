if (! function_exists('isAdmin')) {
    function isAdmin()
    {
        $userid = auth()->user()->id; // Assuming you have access to the logged-in user
        if ($userid) {
            
        }

        return false;
    }
}