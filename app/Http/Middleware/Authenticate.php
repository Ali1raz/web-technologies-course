protected function redirectTo($request)
{
    if (! $request->expectsJson()) {
        return '/student/login'; // or whatever your login URL is
    }
}
