using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace MetodoBiseccion
{
    class Program
    {
        static void Main(string[] args)
        {
           //Primer ejercicios xˆ2-6
           double p =1; //P inicial
           int cantidad = 4; //Cantidad de iteraciones
           double ps = 0;
           Console.WriteLine("Primer ejercicio f(x) = xˆ2-6 hasta p4 ");
           for (int i = 1; i <= cantidad; i++)
           {
               ps = p - (Math.Pow(p, 2) - 6) / (2 * p);
               p = ps;

               Console.WriteLine("P"+i.ToString()+" es "+p.ToString());
           }

          
           //----------------------------------------------------------
            //Segundo ejercicio xˆ3+3xˆ2-1 hasta p4
           Console.WriteLine("Segundo ejercicio f(x)=x^3 +3x^2-1 hasta p4");
           double p2 = 1; //P inicial
           int cantidad2 = 4; //Cantidad de iteraciones
           double ps2 = 0;
           for (int i = 1; i <= cantidad2; i++)
           {
               ps2 = p2 - (Math.Pow(p2,3)+3*Math.Pow(p2,2)-1) / (3*Math.Pow(p2,2)+6*p2);
               p2 = ps2;

               Console.WriteLine("P" + i.ToString() + " es " + p2.ToString());
           }

           Console.ReadKey();
        }
    }
}
