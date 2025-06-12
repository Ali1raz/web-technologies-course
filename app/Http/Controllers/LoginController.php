use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
         
        dd($request->all()); // 👈 Yahan temporary debugging ke liye lagaya hai
    
        // Validate input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
            if (Auth::attempt($credentials)) {
            return redirect()->intended('/courses'); // ya dashboard etc.
        }

        return back()->with('error', 'Invalid credentials');
    

        ]);

        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Security step
            return redirect()->route('courses.index')->with('success', 'Login successful!');
        }

        // ❌ Failed login
        return back()->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
