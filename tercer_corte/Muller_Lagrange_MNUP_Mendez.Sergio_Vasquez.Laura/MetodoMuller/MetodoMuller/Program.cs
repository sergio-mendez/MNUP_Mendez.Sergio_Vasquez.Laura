using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace MetodoMuller
{
    class Program
    {
        static void Main(string[] args)
        {
            //Primer ejercicio f(x)=xˆ3-13x-12
            double x0 =4.5;
            double x1 = 5.5;
            double x2 = 5;

            double h0 = x1 - x0;
            double h1 = x2-x1;

           
            double d0 = ((Math.Pow(x1,3)-(13*x1)-12)-(Math.Pow(x0,3)-13*x0-12))/ (x1-x0);

            double d1 = ((Math.Pow(x2, 3) - 13 * x2 - 12) - (Math.Pow(x1, 3) - 13 * x1 - 12)) / (x2 - x1);

            double a = (d1 - d0) / h1 - h0;

            double b = (a * h1) + d1;

            double c = (Math.Pow(x2, 3)) - (13 * x2)- 12;

            double x3= (x2+(-2*c))/(b+Math.Sqrt((Math.Pow(b,2))-4*a*c));

            Console.WriteLine("Primer ejercicio f(x)=xˆ3-13x-12");
            Console.WriteLine("h0=" + h0);
            Console.WriteLine("h1=" + h1);
            Console.WriteLine("d0="+d0);
            Console.WriteLine("d1="+d1);
            Console.WriteLine("a=" + a);
            Console.WriteLine("b="+b);
            Console.WriteLine("c="+c);
            Console.WriteLine("x3="+x3.ToString());
          

            //Segundo ejercicio ƒ(x) = 2x^4 + 6x^2 + 10

            double h2 = x1 - x0;
            double h3 = x2 - x1;


            double d2 = (2 * Math.Pow(x1, 4) + 6 * Math.Pow(x1, 2) + 10) - (2 * Math.Pow(x0, 4) + 6 * Math.Pow(x0, 2) + 10)/(x1-x0);

            double d3 = (2 * Math.Pow(x2, 4) + 6 * Math.Pow(x2, 2) + 10) - (2 * Math.Pow(x1, 4) + 6 * Math.Pow(x1, 2) + 10)/(x2-x1);

            double a1 = (d3- d2) / h3 - h2;

            double b1 = (a1 * h3) + d2;

            double c1 = (Math.Pow(x2, 3)) - (13 * x2) - 12;

            double x4 = (x2 + (-2 * c1)) / (b1 + Math.Sqrt((Math.Pow(b1, 2)) - 4 * a1 * c1));

            Console.WriteLine("Segundo ejercicio ƒ(x) = 2x^4 + 6x^2 + 10");
            Console.WriteLine("h0=" + h0);
            Console.WriteLine("h1=" + h1);
            Console.WriteLine("d0=" + d2);
            Console.WriteLine("d1=" + d3);
            Console.WriteLine("a=" + a1);
            Console.WriteLine("b=" + b1);
            Console.WriteLine("c=" + c1);
            Console.WriteLine("x3=" + x4.ToString());
            Console.ReadKey();

        }
    }
}
