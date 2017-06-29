import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MenuempleadoComponent } from './menuempleado.component';

describe('MenuempleadoComponent', () => {
  let component: MenuempleadoComponent;
  let fixture: ComponentFixture<MenuempleadoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MenuempleadoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MenuempleadoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
