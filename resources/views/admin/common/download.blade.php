<html>
  <head>
      @if(Session::has('download.in.the.next.request'))
         <meta http-equiv="refresh" content="5;url={{ Session::get('download.in.the.next.request') }}">
      @endif
   <head>

   <body>
   
   </body>
</html>